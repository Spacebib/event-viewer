export const shortName = (eventType) => {
  return eventType.split("\\")[eventType.split("\\").length - 1];
};
