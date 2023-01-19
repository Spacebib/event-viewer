import React, { useMemo } from "react";
import Select from "react-select";
import { useQuery } from "@tanstack/react-query";

export const EventTypeSelect = ({ value, onChange }) => {
  const {
    data: etData,
    isLoading: etLoading,
    error: etError,
  } = useQuery(["event-types"]);

  const eventTypeOptions = useMemo(() => options(etData), [etData]);

  if (etError) {
    return <div>Error</div>;
  }
  return (
    <Select
      className="mr-4 basic-single grow"
      classNamePrefix="select"
      isLoading={etLoading}
      options={eventTypeOptions}
      isClearable={true}
      isSearchable={true}
      name="eventType"
      value={eventTypeOptions.find((x) => x.value === value)}
      onChange={onChange}
      placeholder={"Event Name"}
    />
  );
};

const options = (data) => {
  if (data?.data) {
    return data.data.map((x) => ({
      label: x,
      value: x,
    }));
  }
  return [];
};
