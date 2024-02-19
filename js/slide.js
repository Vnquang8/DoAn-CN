var arr_img=["img/img-slide/s0.jpg","img/img-slide/s1.jpg","img/img-slide/s2.jpg"];
var index=0;
function prev()
{
  index--;
  if(index < 0)
  {
    index = arr_img.length-1
  }
  document.getElementById("hinh").src = arr_img[index];
}
function next()
{
  index++;
  if(index == arr_img.length)
  {
    index = 0;
  }
  document.getElementById("hinh").src = arr_img[index];
}
setInterval("next ()",3000);