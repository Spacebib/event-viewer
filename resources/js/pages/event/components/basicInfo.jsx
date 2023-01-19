import React, { useMemo } from "react";
import { Link } from "wouter";
import clsx from "clsx";

export const BasicInfoCard = ({ event, inDetailView = false }) => {
  const items = useMemo(() => {
    const struct = [
      {
        label: "ID",
        render: (x) => x.id,
      },
      {
        label: "Aggregate Root ID",
        render: (x) => x.aggregateUuid,
      },
      {
        label: "Aggregate Version",
        render: (x) => x.aggregateVersion,
      },
      {
        label: "Happened At",
        render: (x) => x.timeOfRecording,
      },
    ];
    return struct.map((x) => {
      x.value = x.render(event);
      return x;
    });
  }, [event]);
  return (
    <div className="w-full bg-white border rounded-lg shadow-md">
      <div className="flex items-center justify-between p-2 sm:p-4">
        <h5 className="text-xl font-bold leading-none text-gray-900">
          {event.eventType}
        </h5>
        {!inDetailView && (
          <Link
            to={`/event-stream/${event.aggregateUuid}`}
            className="text-sm font-medium text-indigo-600 hover:underline"
          >
            View stream
          </Link>
        )}
      </div>
      <div
        className={clsx({
          "bg-gray-50": true,
          "p-2 sm:p-4": !inDetailView,
          "px-2 sm:px-4 py-1 sm:py-2": inDetailView,
        })}
      >
        <ul role="list" className="divide-y divide-gray-200">
          {renderItems(items, inDetailView)}
        </ul>
      </div>
    </div>
  );
};

const renderItems = (items, condensed = false) => {
  return (
    <>
      {items.map((x) => (
        <li
          className={clsx({
            "first:pt-0 last:pb-0": true,
            "py-3 sm:py-4": !condensed,
            "py-1 sm:py-2": condensed,
          })}
          key={x.label}
        >
          <div className="flex items-center space-x-4">
            <div className="flex-shrink-0 min-w-[10rem]">{x.label}</div>
            <div className="flex-1 min-w-0">
              <p className="text-sm text-gray-900 truncate">{x.value}</p>
            </div>
          </div>
        </li>
      ))}
    </>
  );
};
