import { Redirect, Route, Router, Switch } from "wouter";
import { Events } from "../pages/events";
import { Event } from "../pages/event";
import { EventStream } from "../pages/stream";
import { Dashboard } from "../pages/dashboard";
import { NavLink } from "../components/navLink";

export const Root = () => {
  return (
    <Router base="/event-viewer">
      <div className="flex">
        <nav className="space-y-1 min-w-[10rem]">
          <ul>
            <NavLink href={`/dashboard`}>Dashboard</NavLink>
            <NavLink
              href={`/events`}
              paths={["/events", "/events/:id", "/event-stream/:uuid"]}
            >
              Events
            </NavLink>
          </ul>
        </nav>
        <div className="flex-1 overflow-hidden">
          <Switch>
            <Route path="/">
              <Redirect to="/dashboard" />
            </Route>
            <Route path="/dashboard" component={Dashboard}></Route>
            <Route path="/events/:id" component={Event}></Route>
            <Route path="/event-stream/:uuid" component={EventStream}></Route>
            <Route path="/events" component={Events}></Route>
            <Route>404, Not Found!</Route>
          </Switch>
        </div>
      </div>
    </Router>
  );
};
