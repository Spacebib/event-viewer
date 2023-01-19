import React from "react";
import { BasicInfoCard } from "../../event/components/basicInfo";
import { PayloadCard } from "../../event/components/payload";

export const EventDetail = ({ event }) => {
  if (!event) {
    return null;
  }
  return (
    <div className="mt-4">
      <BasicInfoCard event={event} inDetailView={true} />
      <div className="mt-4"></div>
      <PayloadCard event={event} />
    </div>
  );
};
