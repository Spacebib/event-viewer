import React, { useCallback, useEffect } from "react";
import { EventTypeSelect } from "./eventTypeSelect";
import useQueryString from "../../../hooks/useSyncQueryString";
import { debounce } from "lodash";

export const Filters = ({ onSubmit }) => {
  const [aggregateRootID, setAggregateRootID] = useQueryString(
    "filter.search",
    ""
  );
  const [event, setEvent] = useQueryString("filter.event", "");

  const debouncedSubmit = useCallback(debounce(onSubmit, 800), []);

  useEffect(() => {
    debouncedSubmit({ search: aggregateRootID, event });
  }, [aggregateRootID, event]);

  return (
    <>
      <EventTypeSelect value={event} onChange={(e) => setEvent(e?.value)} />
      <label htmlFor="table-search" className="sr-only">
        Search By Aggregate ID
      </label>
      <div className="relative">
        <input
          type="text"
          id="table-search"
          className="block p-2 pl-6 text-sm text-gray-900 border border-gray-300 rounded-md w-96 focus:ring-indigo-500 focus:border-indigo-500"
          placeholder="Aggregate Root ID"
          value={aggregateRootID}
          onChange={(e) => setAggregateRootID(e.target.value)}
        />
      </div>
    </>
  );
};
