import React from "react";
import { useQuery } from "@tanstack/react-query";
import { BasicInfoCard } from "./components/basicInfo";
import { PayloadCard } from "./components/payload";
import ErrorPage from "../../error-page";

export const Event = ({ params }) => {
  const { id } = params;
  const { data, isLoading, error } = useQuery([`events/${id}`]);
  const event = data?.data;

  if (isLoading) {
    return <div>Loading...</div>;
  }

  if (error) {
    return <ErrorPage error={error} />;
  }
  return (
    <div>
      <BasicInfoCard event={event} />
      <div className="mt-4"></div>
      <PayloadCard event={event} />
    </div>
  );
};
