import Swal from "sweetalert2";

export const updateTaskTotal = () => {
  // count list and update
  const lists = document.querySelectorAll(".list");
  taskTotal.innerText = lists.length;
};

export const updateDoneTaskTotal = () => {
  // count list and update
  const lists = document.querySelectorAll(".list input:checked");
  doneTaskTotal.innerText = lists.length;
};

// create new list
let count = 1;
export const createNewList = (currentTask) => {
  if (!currentTask) {
    console.error("Task content is empty or undefined");
    return;
  }

  const list = listTemplate.content.cloneNode(true);

  // Set the ID for the list item
  const listId = "list" + count++;
  list.querySelector(".list").id = listId;

  // Set the task content in the list
  const taskElement = list.querySelector(".list-task");

  taskElement.innerText = currentTask; // Assign the task content

  // Return the cloned and updated template
  return list;
};

export const deleteList = (listId) => {
  // console.log("U del");
  const currentList = document.querySelector(`#${listId}`);
  // console.log(currentList);
  // if (window.confirm("Are you sure to delete ?")) {
  //   currentList.classList.add("animate__animated", "animate__hinge");

  //   currentList.remove();
  //   // currentList.classList.add("slide-to-right");
  //   // updateDoneTaskTotal();
  //   // updateTaskTotal();
  // }
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "Deleted!",
        text: "Your file has been deleted.",
        icon: "success",
      });
      currentList.remove();
    }
  });
};

export const editList = (listId) => {
  const currentList = document.querySelector(`#${listId}`);

  const listTask = currentList.querySelector(".list-task");
  const listEditBtn = currentList.querySelector(".list-edit-btn");
  const listDoneCheck = currentList.querySelector(".list-done-check");

  listEditBtn.setAttribute("disabled", true);
  listDoneCheck.setAttribute("disabled", true);
  const currentTask = listTask.innerText;
  const newTaskInput = document.createElement("input");
  newTaskInput.className =
    "border border-stone-950 font-mono px-2 py-1 w-[180px] focus-visible:outline-none ";
  newTaskInput.value = currentTask;
  listTask.after(newTaskInput);
  newTaskInput.focus();
  listTask.classList.add("hidden");

  newTaskInput.addEventListener("blur", () => {
    listEditBtn.removeAttribute("disabled");
    listDoneCheck.removeAttribute("disabled");

    // console.log("edit finish");
    listTask.innerText = newTaskInput.value;
    listTask.classList.remove("hidden");
    newTaskInput.remove();
  });

  newTaskInput.addEventListener("keyup", (event) => {
    if (event.key === "Enter") {
      listEditBtn.removeAttribute("disabled");
      listDoneCheck.removeAttribute("disabled");

      //   console.log("edit finish");
      listTask.innerText = newTaskInput.value;
      listTask.classList.remove("hidden");
      newTaskInput.remove();
    }
  });
};

const updateList = () => {};

export const doneList = (listId) => {
  const currentList = document.querySelector(`#${listId}`);

  //   console.log(currentList);
  const listTask = currentList.querySelector(".list-task");
  const listEditBtn = currentList.querySelector(".list-edit-btn");
  const listDoneCheck = currentList.querySelector(".list-done-check");
  //   console.log(listEditBtn);

  listTask.classList.toggle("line-through");
  currentList.classList.add("duration-200");
  currentList.classList.toggle("opacity-20");
  currentList.classList.toggle("scale-90");
  if (listDoneCheck.checked) {
    listEditBtn.setAttribute("disabled", true);
  } else {
    listEditBtn.removeAttribute("disabled");
  }
  // updateDoneTaskTotal();
};

export const addList = (text) => {
  // console.log(taskInput.value);
  listGroup.append(createNewList(text));
  taskInput.value = null;
  // updateTaskTotal();
};
