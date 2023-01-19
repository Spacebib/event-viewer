import { useQuery } from "@tanstack/react-query";
import { fetchCollections } from "../../../hooks/useCollection";

export const useStream = (aggregateRootID) => {
  const { data, isLoading, error } = useQuery(
    [
      "events",
      {
        perPage: 100,
        filter: { search: aggregateRootID },
        sorts: ["aggregate_version"],
      },
    ],
    fetchCollections,
    {
      select: (data) => {
        return data?.data;
      },
    }
  );

  return {
    data,
    isLoading,
    error,
  };
};
