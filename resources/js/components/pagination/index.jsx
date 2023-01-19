import clsx from "clsx";
import React, { useCallback, useEffect, useMemo, useState } from "react";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/react/24/solid";

export const Pagination = ({
  current,
  onChange,
  total,
  perPage = 15,
  aroundSize = 2,
  hideOnSinglePage = true,
  disabled = false,
}) => {
  const [currentPage, setCurrentPage] = useState(current);
  const lastPage = useMemo(() => {
    return Math.ceil(total / perPage);
  }, [total, perPage]);
  const from = useMemo(() => {
    return currentPage * perPage - perPage + 1;
  }, [currentPage, perPage]);
  const to = useMemo(() => {
    return from + perPage - 1;
  }, [from, perPage]);
  const generatePagination = useCallback((lastPage, current, around) => {
    const baseCount = around * 2 + 7;
    const surplus = baseCount - 4;
    const startPosition = around + 4;
    const endPosition = lastPage - around - 3;
    if (lastPage <= baseCount - 2) {
      return Array.from(
        { length: lastPage < 1 ? 1 : lastPage },
        (v, i) => i + 1
      );
    }
    if (current < startPosition) {
      return [
        ...Array.from({ length: surplus }, (v, i) => i + 1),
        "...",
        lastPage,
      ];
    }
    if (current > endPosition) {
      return [
        1,
        "...",
        ...Array.from(
          { length: surplus },
          (v, i) => lastPage - surplus + i + 1
        ),
      ];
    }
    return [
      1,
      "...",
      ...Array.from({ length: around * 2 + 1 }, (v, i) => current - around + i),
      "...",
      lastPage,
    ];
  }, []);

  const paginationArray = useMemo(() => {
    return generatePagination(lastPage, currentPage, aroundSize);
  }, [generatePagination, lastPage, currentPage, aroundSize]);

  const updatePage = (page) => {
    setCurrentPage(page);
    onChange(page);
  };
  const handleNext = () => {
    if (currentPage >= lastPage) {
      return;
    }
    updatePage(currentPage + 1);
  };
  const handlePrevious = () => {
    if (currentPage <= 1) {
      return;
    }
    updatePage(currentPage - 1);
  };
  const handleClick = (page, index) => {
    const newCurrent = parseInt(page, 10);
    if (!newCurrent) {
      return index >= 5 ? handleNext() : handlePrevious();
    }
    updatePage(newCurrent);
  };

  useEffect(() => {
    if (current !== currentPage) {
      updatePage(current);
    }
  }, [current]);

  if (!total) {
    return null;
  }

  if (hideOnSinglePage && lastPage <= 1) {
    return null;
  }
  return (
    <div className="flex items-center justify-between py-5">
      <div className="flex justify-between flex-1 sm:hidden">
        <div
          onClick={handlePrevious}
          className="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50"
        >
          Previous
        </div>
        <div
          onClick={handleNext}
          className="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50"
        >
          Next
        </div>
      </div>
      <div className="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
          <p className="text-sm text-gray-700">
            Showing <span className="font-medium">{from}</span> to{" "}
            <span className="font-medium">{to}</span> of{" "}
            <span className="font-medium">{total}</span> results
          </p>
        </div>
        <div>
          <nav
            className="relative z-0 inline-flex -space-x-px rounded-md shadow-sm"
            aria-label="Pagination"
          >
            <div
              onClick={handlePrevious}
              className="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-pointer rounded-l-md hover:bg-gray-50"
            >
              <span className="sr-only">Previous</span>
              <ChevronLeftIcon className="w-5 h-5" aria-hidden="true" />
            </div>
            {paginationArray.map((page, index) => (
              <div
                key={index}
                onClick={() => !disabled && handleClick(page, index)}
                className={clsx({
                  "cursor-pointer": true,
                  "relative inline-flex items-center px-4 py-2 border text-sm font-medium": true,
                  "z-10 bg-blue-50 border-blue-500 text-indigo-600":
                    page === currentPage,
                  "bg-white border-gray-300 text-gray-500 hover:bg-gray-50":
                    page !== currentPage,
                })}
              >
                {page}
              </div>
            ))}

            <div
              onClick={handleNext}
              className="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-pointer rounded-r-md hover:bg-gray-50"
            >
              <span className="sr-only">Next</span>
              <ChevronRightIcon className="w-5 h-5" aria-hidden="true" />
            </div>
          </nav>
        </div>
      </div>
    </div>
  );
};
