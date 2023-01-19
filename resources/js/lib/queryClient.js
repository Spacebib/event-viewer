import { QueryClient } from "@tanstack/react-query";
import { req } from "./request";

export const client = new QueryClient({
  defaultOptions: {
    queries: {
      queryFn({ queryKey }) {
        return req.get("/event-viewer/api/" + queryKey[0]);
      },
      select(data) {
        return data.data;
      },
      refetchOnWindowFocus: false,
      retry: false,
    },
  },
});
