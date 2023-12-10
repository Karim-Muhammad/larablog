// Install What you need here : plugins, editors, etc.
// import BalloonEditor from "@ckeditor/ckeditor5-build-balloon";
// window.BalloonEditor = BalloonEditor;

import Choices from "choices.js";
console.log(Choices);

const element = document.querySelector(".tags");
const choices = new Choices(element);
