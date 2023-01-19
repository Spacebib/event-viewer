import React, { useState } from "react";
import { Table } from "../../components/table";
import { Link } from "wouter";
import { Filters } from "./components/filters";
import { useCollection } from "../../hooks/useCollection";
import { shortName } from "../../lib/utils";

export const Events = () => {
  const [filter, setFilter] = useState({ search: "", event: "" });
  const { data, isLoading, error, setPage } = useCollection("events", filter);

  if (error) {
    return <div>Error</div>;
  }
  return (
    <div className="w-full overflow-x-auto">
      <div className="flex justify-between items-center pb-4">
        <Filters onSubmit={setFilter} />
      </div>
      <Table
        dataSource={data?.data}
        columns={[
          {
            title: "Event Type",
            key: "type",
            render: (item) => {
              return <span>{shortName(item.eventType)}</span>;
            },
          },
          {
            title: "Aggregate Root ID",
            key: "aggregateUuid",
            dataIndex: "aggregateUuid",
          },
          {
            title: "Date of Recording",
            key: "timeOfRecording",
            dataIndex: "timeOfRecording",
          },
          {
            title: "Action",
            key: "action",
            render: (item) => (
              <Link
                className="font-medium text-indigo-600 hover:underline"
                to={`/events/${item.id}`}
              >
                View
              </Link>
            ),
          },
        ]}
        loading={isLoading}
        setPage={setPage}
        meta={data?.meta}
      />
    </div>
  );
};
