import React from "react";
import { useQuery } from "@tanstack/react-query";
import ErrorPage from "../../error-page";

export const Dashboard = () => {
  const { data, isLoading, error } = useQuery([`stats`]);
  if (isLoading) {
    return <div>Loading...</div>;
  }

  if (error) {
    return <ErrorPage error={error} />;
  }
  return (
    <div className="w-full overflow-x-auto">
      <div className="border border-gray-200 rounded-lg shadow-sm md:mb-12">
        <h5 className="p-2 text-base font-semibold text-gray-900 bg-white sm:p-4 md:text-xl">
          Overview
        </h5>
        <div className="flex justify-center text-center border-b border-gray-200 bg-gray-50 md:border-r">
          <div className="flex-grow border-r">
            <div className="p-4">
              <small className="text-uppercase">Total Events</small>
              <h4 className="mt-4 mb-0">{data.totalEvents}</h4>
            </div>
          </div>
          <div className="flex-grow border-r">
            <div className="p-4">
              <small className="text-uppercase">Maximum Version</small>
              <h4 className="mt-4 mb-0">{data.maxVersion}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};
