<?php

if (debug){
  $ver = rand(0,10000); //avoid caching
} else {
  $ver = 1; //avoid caching
}