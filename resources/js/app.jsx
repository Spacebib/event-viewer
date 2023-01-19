import React from "react";
import ReactDOM from "react-dom/client";
import { QueryClientProvider } from "@tanstack/react-query";
import { Root } from "./routes/root";
import { client } from "./lib/queryClient";

const App = () => {
  return (
    <QueryClientProvider client={client}>
      <Root />
    </QueryClientProvider>
  );
};

const root = ReactDOM.createRoot(document.getElementById("event-viewer"));

root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);
