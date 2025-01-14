import { addList } from "./list.js";

const intialRender = () => {
  const tasks = ["work", "learn-js", "watch movie"];

  tasks.forEach((task) => {
    addList(task);
  });
};

export default intialRender;
