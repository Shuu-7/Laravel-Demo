<head>
<style>
.center {
  text-align: center;
  margin-top: 10px;
}

.pagination {
  display: inline-block;
}
.pagination2{
    display: none;
}
.pagination3{
    display: none;
}
.pagination2 a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
  margin: 0 4px;
}

.pagination2 a.active {
  /* background-color: rgba(126, 214, 223,1.0);
  border: 1px solid  rgba(126, 214, 223,1.0); */
  color: white;
  background-color: rgba(9, 132, 227,1.0);
  border: 1px solid rgba(9, 132, 227,1.0);
}

.pagination2 a:hover:not(.active) {background-color: #ddd;}

.pagination3 a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
  margin: 0 4px;
}

.pagination3 a.active {
  /* background-color:  rgba(126, 214, 223,1.0);
  border: 1px solid rgba(126, 214, 223,1.0); */
  color: white;
  background-color: rgba(9, 132, 227,1.0);
  border: 1px solid  rgba(9, 132, 227,1.0);
}

.pagination3 a:hover:not(.active) {background-color: #ddd;}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
  margin: 0 4px;
}

.pagination a.active {
  /* background-color: rgba(126, 214, 223,1.0);
  border: 1px solid  rgba(126, 214, 223,1.0); */
  color: white;
  background-color:rgba(9, 132, 227,1.0);
  border: 1px solid rgba(9, 132, 227,1.0);
}

.pagination a:hover:not(.active) {background-color: #ddd;}
</style>
</head>
<body>
<div class="center">
  <div class="pagination">
  <a href="skillRecords.php?page=0" class='firstNav'>&laquo;&laquo;</a>
  <a href="skillRecords.php?page=0" class='previous'>&laquo;</a>
  <a href="skillRecords.php?page=0" class='1'>1</a>
  <a href="skillRecords.php?page=1" class='2'>2</a>
  <a href="skillRecords.php?page=2" class='3'>3</a>
  <a href="skillRecords.php?page=3" class='4'>4</a>
  <a href="skillRecords.php?page=4" class='5'>5</a>
  <a href="skillRecords.php?page=5" class='6'>6</a>
  <a href='skillRecords.php?page=6' class='7'>7</a>
  <a href="skillRecords.php?page=7" class='imNext'>&raquo;</a>
  <a href="skillRecords.php?page=18" class='final'>&raquo;&raquo;</a>
  </div>
</div>
<div class="center">
  <div class="pagination2">
  <a href="skillRecords.php?page=0" class='firstNav'>&laquo;&laquo;</a>
  <a href="skillRecords.php?page=5" class='previous'>&laquo;</a>
  <a href="skillRecords.php?page=6" class='7'>7</a>
  <a href="skillRecords.php?page=7" class='8'>8</a>
  <a href="skillRecords.php?page=8" class='9'>9</a>
  <a href="skillRecords.php?page=9" class='10'>10</a>
  <a href="skillRecords.php?page=10" class='11'>11</a>
  <a href="skillRecords.php?page=11" class='12'>12</a>
  <a href='skillRecords.php?page=12' class='13'>13</a>
  <a href="skillRecords.php?page=13" class='imNext'>&raquo;</a>
  <a href="skillRecords.php?page=18" class='final'>&raquo;&raquo;</a>
  </div>
</div>
<div class="center">
  <div class="pagination3">
  <a href="skillRecords.php?page=0" class='firstNav'>&laquo;&laquo;</a>
  <a href="skillRecords.php?page=5" class='previous'>&laquo;</a>
  <a href="skillRecords.php?page=12" class='13'>13</a>
  <a href="skillRecords.php?page=13" class='14'>14</a>
  <a href="skillRecords.php?page=14" class='15'>15</a>
  <a href="skillRecords.php?page=15" class='16'>16</a>
  <a href="skillRecords.php?page=16" class='17'>17</a>
  <a href="skillRecords.php?page=17" class='18'>18</a>
  <a href='skillRecords.php?page=18' class='19'>19</a>
  <a href="skillRecords.php?page=18" class='imNext'>&raquo;</a>
  <a href="skillRecords.php?page=18" class='final'>&raquo;&raquo;</a>
  </div>
</div>
</body>