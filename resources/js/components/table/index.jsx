import _ from "lodash";
import React from "react";
import { Pagination } from "../pagination";
import clsx from "clsx";

export const Table = ({
  columns,
  dataSource,
  meta,
  setPage,
  loading = false,
  emptyPlaceholder = "Empty",
}) => {
  return (
    <>
      <div className="-mx-4 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-sm">
        {loading ? (
          <div className="px-4 py-5 sm:px-6">Loading...</div>
        ) : dataSource.length === 0 ? (
          <div className="px-4 py-5 bg-white sm:px-6">{emptyPlaceholder} </div>
        ) : (
          <table className="min-w-full divide-y divide-gray-300">
            <thead className="bg-gray-50">
              <tr>
                {columns.map((x) => (
                  <th
                    key={x.key}
                    scope="col"
                    className={clsx({
                      "whitespace-nowrap max-w-[10rem] py-3.5 pl-2 pr-1 text-left text-sm font-semibold text-gray-900 sm:pl-3": true,
                      hidden: x?.hide,
                    })}
                  >
                    <div className="inline-flex group">{x.title}</div>
                  </th>
                ))}
              </tr>
            </thead>

            <tbody className="bg-white divide-y divide-gray-200">
              {dataSource.map((item) => (
                <tr key={item.id} className="hover:bg-gray-50">
                  {columns
                    .filter((x) => !x?.hide)
                    .map((col) => {
                      return (
                        <td
                          key={col.key}
                          className="py-4 pl-2 pr-1 text-sm text-gray-500 sm:pl-3"
                        >
                          {col.render
                            ? col.render(item)
                            : _.get(item, col?.dataIndex ?? "nonExist")}
                        </td>
                      );
                    })}
                </tr>
              ))}
            </tbody>
          </table>
        )}
      </div>
      {meta && (
        <Pagination
          current={meta.current_page ?? 1}
          total={meta.total ?? dataSource?.length ?? 0}
          perPage={meta.per_page}
          onChange={function (page) {
            setPage?.(page);
          }}
        />
      )}
    </>
  );
};
