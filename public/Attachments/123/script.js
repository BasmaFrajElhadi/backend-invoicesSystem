// select elements
let bars = document.querySelector(".bars");
let mainContainer = document.querySelector(".mainContainer");
let prevBtn = document.querySelector('.prevBtn');
let nextBtn = document.querySelector('.nextBtn');
let progress = document.querySelector('.progress');
let steps= document.querySelectorAll('.step');
let formSteps= document.querySelectorAll('.formStep');
let currentStep =0;


// open Nav
bars.addEventListener('click',function(){
    mainContainer.classList.toggle('openNav');
})

// form steps

// update buttons 
function updateBtn(){
    // if theres more steps
    if(currentStep+1 == steps.length){
        nextBtn.setAttribute('disabled', '');
    }else{
        nextBtn.disabled = false;
    }
    // if there is not prev step
    if(currentStep>0){
        prevBtn.disabled = false;
    }else{
        prevBtn.setAttribute('disabled', '');
    }
}

// update the progress width
function progressUpdate(){
    // (steps.length-1) => number of spaces between each steps
    progress.style.width = (100/(steps.length-1))*currentStep+"%";
}

// form tab
function updateFormStep(){
    // remove active from all form steps
    formSteps.forEach(step=>{
        step.classList.remove('active');
    })
    // add active only for step with same currentStep
    formSteps.forEach(step=>{
        step.dataset.step==currentStep+1?step.classList.add('active'):"";
    })
}

if(nextBtn!=null && prevBtn!=null){
//nextBtn click 
nextBtn.addEventListener("click",function(){
    steps[++currentStep].classList.add('active');
    updateBtn();
    progressUpdate();
    updateFormStep();
})

//prevBtn click 
prevBtn.addEventListener("click",function(){
    if(currentStep >0){
        steps[currentStep--].classList.remove('active');
        updateBtn();
        progressUpdate();
        updateFormStep();
    }
})
}//end if
