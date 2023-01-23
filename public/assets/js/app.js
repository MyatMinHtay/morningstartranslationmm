
const body = document.getElementById("nightbody");
const dayone =  document.getElementById('dayone');
const toggleiconone = document.getElementById('toggleiconone');

const daytwo = document.getElementById('daytwo');
const toggleicontwo = document.getElementById("toggleicontwo");

function changedayandnight(){
        isactive = body.classList.contains('active');
       
        if(isactive){
                body.classList.remove('active');
                dayone.innerText = "Night";
                daytwo.innerText = "Night";
                toggleiconone.src = "./assets/img/moon.png";
                toggleicontwo.src = "./assets/img/moon.png";
               
        }else{
                body.classList.add('active');
                dayone.innerText = 'Day';
               daytwo.innerText = "Day";
                toggleiconone.src = "./assets/img/sunny.png";
                toggleicontwo.src = "./assets/img/sunny.png";
              
        }
}


// carousel 

 
var idx = 0;

const prevBtn = document.querySelector(".prevBtn");
const nextBtn = document.querySelector('.nextBtn');

const cardwrapper = document.querySelector('.card-wrapper');
const cardcontainers = document.querySelectorAll('.cardcontainer');
console.log(cardcontainers.length);
prevBtn.addEventListener('click',function(){
        
        idx--;
        console.log(idx);
        changeimage();
});

nextBtn.addEventListener('click',function(){
        idx++;
        console.log(idx);
        changeimage();
});

function changeimage(){
        if(idx >= cardcontainers.length - 1){
                idx = 0;
            }else if(idx <= 0){
                idx = cardcontainers.length - 1;
            }



                cardwrapper.style.transform = `translate(${-idx * 300}px)`;

}


