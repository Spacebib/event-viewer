import React, { useMemo } from "react";
import { JsonViewer } from "@textea/json-viewer";

export const PayloadCard = ({ event }) => {
  const payload = useMemo(
    () => (event?.payload ? JSON.parse(event.payload) : {}),
    [event]
  );
  return (
    <div className="w-full bg-white border rounded-lg shadow-md">
      <div className="flex items-center justify-between p-2 sm:p-4">
        <h5 className="text-xl font-bold leading-none text-gray-900">
          Payload
        </h5>
      </div>
      <div className="p-2 bg-gray-50 sm:p-4">
        <JsonViewer value={payload} />
      </div>
    </div>
  );
};
