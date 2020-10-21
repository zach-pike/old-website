<!DOCTYPE html>
<html>

<input type="text" id="one" placeholder="Text Area">
<button onclick="Root()">Square Root</button><br>
<input type="text" id="two" placeholder="Text Area"><br>

<button onclick="Add()">Add</button>
<button onclick="Minus()">Minus</button>
<button onclick="Times()">Times</button>
<button onclick="Divide()">Divide</button>
<button onclick="Power()">Power</button>

<script>
function Add() {
var a = document.getElementById("one").value;
var b = document.getElementById("two").value;
document.writeln(a * 1 + b * 1);
}

function Minus() {
var a = document.getElementById("one").value;
var b = document.getElementById("two").value;
document.writeln(a * 1 - b * 1);
}

function Times() {
var a = document.getElementById("one").value;
var b = document.getElementById("two").value;
document.writeln((a * 1) * (b * 1));
}

function Divide() {
var a = document.getElementById("one").value;
var b = document.getElementById("two").value;
document.writeln((a * 1) / (b * 1));
}

function Power() {
var a = document.getElementById("one").value;
var b = document.getElementById("two").value;
document.writeln(Math.pow(a , b));
}

function Root() {
var a = document.getElementById("one").value;
document.writeln(a ^ b);
}

</script>
</html>