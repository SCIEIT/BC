<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style."/>
  <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development"/>
  <link rel='shortcut icon' type='image/x-icon' href='../favicon.ico' />
  <title><?php echo ($title); ?></title>
  <link href="/Public/css/metro.min.css" rel="stylesheet"/>
  <link href="/Public/css/metro-icons.min.css" rel="stylesheet"/>
  <link href="/Public/css/metro-responsive.min.css" rel="stylesheet"/>
  <link href="/Public/css/metro-rtl.min.css" rel="stylesheet"/>
  <link href="/Public/css/metro-schemes.min.css" rel="stylesheet"/>

  <script src="/Public/js/jquery.min.js"></script>
  <script src="/Public/js/metro.min.js"></script>
  <script src="/Public/js/prettify/run_prettify.js"></script>
</head>

  <div id='preloader'>
    <div class="flex-grid" style="position:absolute;top:45%;left:45%">
      <div class="row">
        <div data-role="preloader" data-type="cycle" data-style="color"></div>
      </div>
      <div class="row">
        <h3>Loading...</h3>
      </div>
    </div>
  </div>