'use strict';

const ham_btn = document.querySelector('#ham_btn');
const menu = document.querySelector('#menu');
const main = document.querySelector('#main');
const deadline = document.querySelector('#deadline');
const body = document.body;



ham_btn.addEventListener('click', function () {
  ham_btn.classList.toggle('active');
  menu.classList.toggle('active');
  main.classList.toggle('active');
  deadline.classList.toggle('active');
});
