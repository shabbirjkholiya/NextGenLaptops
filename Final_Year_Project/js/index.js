//console.log("Hello");
let img = document.getElementById('slider');
let leftbtn = document.getElementById('lbtn');
let rightbtn = document.getElementById('rbtn');
let cart_btn = document.querySelectorAll('.addtocart');
let scrol = document.getElementById('scrol');
let pro1 = document.getElementById('pro1');
let pro = 0;
console.log(leftbtn);


let counter = 1;


rightbtn.addEventListener('click',(e)=>{
    console.log("right clicked");
    e.preventDefault();
    //console.log("hello");
    counter++;
    if(counter == 6)
    {
        counter = 1;
        img.src = `Assest/sliders/${counter}.jpg`;
        counter++;
    }
    img.src = `Assest/sliders/${counter}.jpg`;
   
   
    
});
leftbtn.addEventListener('click',(e)=>{
    console.log("left clicked");
    e.preventDefault();
    //console.log("hello");
    if(counter == 6 || counter < 6)
    {
        if(counter == 1)
        {
            counter = 6;
        }
        counter--
        img.src = `Assest/sliders/${counter}.jpg`;  
    }
    
});
for (let i = 0; i < cart_btn.length; i++) {
    cart_btn[i].addEventListener('click',(e)=>{
        e.preventDefault();
        console.log("btn click");
        let msg = document.querySelector('.msg');
        console.log(msg);
        alert('Added into cart');
       
    });  
}
/*setTimeout(()=>{
    
    if(counter==1)
    {
        img.src = `Assest/sliders/img${1}.jpg`;
    }
   
    counter++;
},1000);
setTimeout(()=>{
    if(counter == 2)
    {
        img.src = `Assest/sliders/img${2}.jpg`;
    }
    counter++;
},2000);
setTimeout(()=>{
    if(counter==3)
    {
        img.src = `Assest/sliders/img${3}.jpg`;
    }
    counter++;
},3000);
setTimeout(()=>{
    if(counter==4)
    {
        img.src = `Assest/sliders/img${4}.jpg`;
    }
    counter++;
},4000);
setTimeout(()=>{
    if(counter==5)
    {
        img.src = `Assest/sliders/img${5}.jpg`;    
    }
    counter++;
},5000);
setTimeout(()=>{
    if(counter==6)
    {
        img.src = `Assest/sliders/img${6}.jpg`;
        counter=1;
        
    }
   
},6000);*/




