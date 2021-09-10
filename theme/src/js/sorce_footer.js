document.addEventListener('DOMContentLoaded', () => {
    console.log('content loaded');
    addFormRadioToggle();
});
function addFormRadioToggle(){
    let uploadformpage = document.getElementById('page-coach-upload-form');
    if(uploadformpage){
        console.log('got here')
        let radiobuttons = document.getElementsByName('filetyperadio');
        if(radiobuttons){
            for(let el of radiobuttons){
                el.addEventListener('click', (e) =>{
                    let targetid = e.target.value.toLowerCase() + '_file';
                    let files = document.getElementsByClassName('filetype');
                    for(let file of files){
                        if(file.id === targetid){
                            file.classList.add('active');
                        } else {
                            file.classList.remove('active');
                        }
                    }

                    console.log(targetid); 
                });
            }
        }
        


    }
}