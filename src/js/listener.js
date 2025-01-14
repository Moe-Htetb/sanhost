import {
  addTaskBtnHandler,
  deleteAllHandler,
  doneAllHandler,
  listGroupHandler,
  taskInputHandler,
} from "./handler.js";
import {
  addTaskBtn,
  deleteAll,
  doneAll,
  listGroup,
  taskInput,
} from "./selector.js";

const listener = () => {
  addTaskBtn.addEventListener("click", addTaskBtnHandler);
  taskInput.addEventListener("keyup", taskInputHandler);
  listGroup.addEventListener("click", listGroupHandler);
  deleteAll.addEventListener("click", deleteAllHandler);
  doneAll.addEventListener("click", doneAllHandler);
};

export default listener;
