
function doShowMore(event){
  let target = event.target;
  if(!target.classList.contains('show-more-button')) target = event.target.closest('.show-more-button');
  let datatarget = document.getElementById(target.dataset.target);
  let fadetargetselector = target.dataset.target.replace('portfolio', 'excerpt');
  let fadetarget = document.getElementById(fadetargetselector);
  if(datatarget){
    let finishSentence = datatarget.parentElement.querySelector('.finish-sentence');
    collapseExpand(target, datatarget);
    if(finishSentence) finishSentence.classList.toggle('active');

    //fadeElement(fadetarget);
    fadetarget.classList.toggle('hidden');
  }
  if(target.innerText === 'show more'){
    target.innerText = 'show less'
  } else {
    target.innerText = 'show more'
  }

}

function fadeElement(element){
  if(!element.classList.contains('fadeout')){
    element.classList.add('fadeout');
    element.classList.remove('fadein');
  } else {
    element.classList.add('fadein');
    element.classList.remove('fadeout');
  }
}
function collapseSection(element) {
    // get the height of the element's inner content, regardless of its actual size
    var sectionHeight = element.scrollHeight;
    var elementTransition = element.style.transition;
    element.style.transition = '';
    
    // on the next frame (as soon as the previous style change has taken effect),
    // explicitly set the element's height to its current pixel height, so we 
    // aren't transitioning out of 'auto'
    requestAnimationFrame(function() {
      element.style.height = sectionHeight + 'px';
      element.style.transition = elementTransition;
      
      // on the next frame (as soon as the previous style change has taken effect),
      // have the element transition to height: 0
      requestAnimationFrame(function() {
        element.style.height = 0 + 'px';
      });
    });
    // mark the section as "currently collapsed"
    element.setAttribute('data-collapsed', 'true');
  }

function expandSection(element) {
    var sectionHeight = element.scrollHeight;
    element.style.height = sectionHeight + 'px';

    // when the next css transition finishes (which should be the one we just triggered)
    element.addEventListener('transitionend', function nameit(e) {
      // remove this event listener so it only gets triggered once
      //element.removeEventListener('transitionend', arguments.callee);
      element.removeEventListener('transitionend', nameit);
      
      // remove "height" from the element's inline styles, so it can return to its initial value
      element.style.height = null;
    });
    
    element.setAttribute('data-collapsed', 'false');
}
function getSelectorFromLink(link){
  let selector = link.split('#').pop();
  return (selector) ? '#' + selector : false;
}
function collapseExpand(target, datatarget){
  let isCollapsed = (datatarget.getAttribute('data-collapsed') === 'true');
  if(isCollapsed){
    expandSection(datatarget);
  } else {
    collapseSection(datatarget);
  }
  target.classList.toggle('expanded');
}

