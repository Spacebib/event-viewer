import React from "react";
import clsx from "clsx";
import { shortName } from "../../../lib/utils";
import Xarrow from "react-xarrows";

export const EventCard = ({ event, index, choose, active = false }) => {
  return (
    <React.Fragment>
      <div
        id={"ep-" + index}
        onClick={() => choose(event)}
        className={clsx({
          "relative border shadow rounded-md px-2 py-4 cursor-pointer bg-white hover:bg-gray-100 hover:text-indigo-700": true,
          "bg-gray-100 text-indigo-700": active,
        })}
      >
        <span>{shortName(event.eventType)}</span>
        {index > 0 && (
          <Xarrow
            start={`ep-${index - 1}`}
            startAnchor={"right"}
            endAnchor={"left"}
            end={`ep-${index}`}
            color={"rgb(67 56 202)"}
            strokeWidth={2}
            headSize={4}
          />
        )}
      </div>
    </React.Fragment>
  );
};
