import React, { useEffect, useState } from "react";
import ErrorPage from "../../error-page";
import { useStream } from "./hooks/useStream";
import { Xwrapper } from "react-xarrows";
import { EventDetail } from "./components/eventDetail";
import { EventCard } from "./components/eventCard";

export const EventStream = ({ params }) => {
  const { uuid } = params;
  const { data, isLoading, error } = useStream(uuid);
  const [currentEvent, setCurrentEvent] = useState(null);

  useEffect(() => {
    if (null === currentEvent && data) {
      setCurrentEvent(data[0] ?? null);
    }
  }, [data, currentEvent]);

  if (isLoading) {
    return <div>Loading...</div>;
  }
  if (error) {
    return <ErrorPage error={error} />;
  }
  return (
    <div>
      <div className="flex w-full space-x-8 overflow-x-scroll sm:space-x-12">
        <Xwrapper>
          {data?.map((x, i) => (
            <EventCard
              key={x.id}
              event={x}
              index={i}
              active={currentEvent?.id === x.id}
              choose={setCurrentEvent}
            />
          ))}
        </Xwrapper>
      </div>

      <EventDetail event={currentEvent} />
    </div>
  );
};
