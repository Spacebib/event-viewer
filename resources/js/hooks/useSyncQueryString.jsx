import { useState, useCallback } from "react";
import _ from "lodash";
import qs from "qs";

function useQueryString(key, initialValue) {
  const [value, setValue] = useState(getQueryStringValue(key) ?? initialValue);
  const onSetValue = useCallback(
    (newValue) => {
      setValue(newValue);
      setQueryStringValue(key, newValue);
    },
    [key]
  );

  return [value, onSetValue];
}

export default useQueryString;

const setQueryStringWithoutPageReload = (qsValue) => {
  const url = new URL(window.location.href);
  removeEmptyString(qsValue);
  url.search = qs.stringify(qsValue);
  window.history.pushState(null, "", url);
};

/**
 * Set query string value by name.
 * support set nested value with 'filter.status' from filter[status]
 * @param key
 * @param value
 * @param queryString
 */
export const setQueryStringValue = (
  key,
  value,
  queryString = window.location.search
) => {
  setQueryStringWithoutPageReload(mergeQS(key, value, queryString));
};

/**
 * Get query string value by name.
 * support get nested value with 'filter.status' from filter[status]
 * @param key
 * @param queryString
 */
export const getQueryStringValue = (
  key,
  queryString = window.location.search
) => {
  const values = qs.parse(queryString, { ignoreQueryPrefix: true });

  return getNestedObject(values, key.split("."));
};

export const mergeQS = (key, value, queryString = window.location.search) => {
  if (value === undefined) {
    value = "";
  }
  const values = qs.parse(queryString, { ignoreQueryPrefix: true });
  const parts = key.split(".");
  const withBracketNotation = parts.reduce((prev, curr, index) => {
    if (index === 0) {
      return curr;
    }
    return `${prev}[${curr}]`;
  }, "");
  const added = qs.parse(withBracketNotation + "=" + value);
  return _.merge(values, added);
};

const getNestedObject = (nestedObj, pathArr) => {
  return pathArr.reduce(
    (obj, key) => (obj && obj[key] !== "undefined" ? obj[key] : undefined),
    nestedObj
  );
};

function removeEmptyString(object) {
  Object.entries(object).forEach(([key, value]) => {
    if (value && typeof value === "object") removeEmptyString(value);
    if (
      (value && typeof value === "object" && !Object.keys(value).length) ||
      value === null ||
      value === undefined ||
      value.length === 0
    ) {
      if (Array.isArray(object)) object.splice(key, 1);
      else delete object[key];
    }
  });
  return object;
}
