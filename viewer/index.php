<!DOCTYPE html>
<script>
/*
 * Copyright (c) 2017 University of Utah 
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. Neither the name of the copyright holder nor the names of its
 *    contributors may be used to endorse or promote products derived from
 *    this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */
</script>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>ViSUS WebViewer</title>
        
   
        <script src="../ext/bootstrap/jquery/jquery.min.js"></script>
        
        <script src="../ext/bootstrap/js/bootstrap.min.js"></script>
       
        <link rel="stylesheet" href="../ext/bootstrap/css/bootstrap.min.css">

</head>


<body style="background-color:#000">
<div id="nav-placeholder"></div>

<script>
$(function(){
  $("#nav-placeholder").load("../navbar.php", function(){ 
     $("img[src='site_logo.gif']").attr('src', '../site_logo.gif');
     $("a[href='datasets.php']").attr('href', '../datasets.php');
     $("a[href='index.php']").attr('href', '../index.php');
     $("a[href='viewer/']").attr('href', '../viewer/');
	 $("a[href='upload/']").attr('href', '../upload/');
     $("a[href='logout.php']").attr('href', '../logout.php');
  } );
});
</script>

<script>
   document.write('<iframe style="padding-top:70px; border:0" width="' + $(window).width() + '"  height="' + $(window).height()+ '" src="../ext/visus/viewer.html"/>');
</script>
  
</body>
</html>
