<?php

if (Auth::user()->author === 1) {
	echo $task->user->id;
}

if (Auth::user()->author === 2) {
	echo $task->user->username;
}

if (Auth::user()->author === 3) {
	echo $task->user->last_name . ', ' . $task->user->first_name;
}

if (Auth::user()->author === 4) {
	echo $task->user->first_name . ' ' . $task->user->last_name;
}