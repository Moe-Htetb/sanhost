import intialRender from "./intialRender.js";
import listener from "./listener.js";
import observer from "./observer.js";

class Todo {
  inint() {
    observer();
    // console.log("todo app start");
    intialRender();
    listener();
  }
}
export default Todo;
