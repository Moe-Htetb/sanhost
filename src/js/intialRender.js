import { addList } from "./list.js";

const intialRender = () => {
  const tasks = ["work", "learn-js", "watch movie", "learn-linux", "learn-cli"];

  tasks.forEach((task) => {
    addList(task);
  });
};

export default intialRender;
