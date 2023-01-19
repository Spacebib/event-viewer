import React from "react";
import { Link, useRouter } from "wouter";

const navLinkClasses =
  "group flex items-center py-2 text-base font-medium rounded-md";
export const NavLink = (props) => {
  const patterns = props.paths ?? [props.href];
  const router = useRouter();
  const [path] = router.hook(router);
  const isActive = patterns.reduce(
    (acc, x) => acc || router.matcher(x, path)[0],
    false
  );
  return (
    <Link {...props}>
      <a className={`${navLinkClasses}  ${isActive ? "text-indigo-600" : ""}`}>
        {props.children}
      </a>
    </Link>
  );
};
