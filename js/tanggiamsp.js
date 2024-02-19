let minus = document.querySelector(".minus");
    let num = document.querySelector(".number");
    let plus = document.querySelector(".plus");
    let a = 1;
    plus.addEventListener("click",()=>{
      a++;
      num.innerText = a;
      console.log(a);
    });
    minus.addEventListener("click",()=>{
      if(a>1)
      {
        a--;
        num.innerText = a;
        console.log(a);
      }
    });