import { useQuery } from "@tanstack/react-query";
import qs from "qs";
import { req } from "../lib/request";
import useQueryString from "./useSyncQueryString";
import React from "react";

export const useCollection = (name, filter = {}, sorts = []) => {
  const [page, setPage] = useQueryString("page", 1);

  const { data, isLoading, error } = useQuery(
    [name, { page, filter, sorts }],
    fetchCollections,
    {
      select: (data) => {
        return data;
      },
    }
  );

  return {
    data,
    isLoading,
    error,
    page,
    setPage,
    filter,
    sorts,
  };
};

export function fetchCollections({ queryKey }) {
  const [_key, { page, sorts = [], filter, perPage }] = queryKey;

  const filterObj = {};
  for (const [key, value] of Object.entries(filter)) {
    if (typeof value === "string" && value === "") {
      continue;
    }
    filterObj[key] = value;
  }

  const sortsStr = sorts.join(",");

  const qsObj = {};
  for (const [key, value] of Object.entries({
    page,
    perPage,
    filter: filterObj,
    sort: sortsStr,
  })) {
    if (!!value) {
      qsObj[key] = value;
    }
  }
  const queryString = qs.stringify(qsObj);

  return req
    .get(`/event-viewer/api/${_key}?${queryString}`)
    .then((response) => response?.data);
}
