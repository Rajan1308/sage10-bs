import domReady from '@roots/sage/client/dom-ready';
import 'bootstrap/dist/js/bootstrap.bundle.min';

import barba from '@barba/core';
import gsap from 'gsap';


function animateHero(container) {
  const heroSections = container.querySelectorAll('.hero');

  heroSections.forEach((section, index) => {
    gsap.from(section, {
      opacity: 0,
      y: 30,
      duration: 0.8,
      delay: index * 0.2, // stagger if multiple
      ease: 'power2.out',
    });
  });
}


function initBarba() {
  const wrapper = document.querySelector('[data-barba="wrapper"]');
  if (!wrapper) {
    console.warn('❌ Barba wrapper not found. Retrying...');
    setTimeout(initBarba, 50);
    return;
  }

  console.log('✅ Barba wrapper found, initializing...');

  barba.init({
    transitions: [
      {
        name: 'fade-westpack',
        from: { namespace: ['westpack'] },
        to: { namespace: ['westpack'] },
        leave(data) {
          return gsap.to(data.current.container, {
            opacity: 0,
            duration: 0.3,
          });
        },
        enter(data) {
          return gsap.from(data.next.container, {
            opacity: 0,
            duration: 0.3,
            onComplete: () => animateHero(data.next.container),
          });
        },
      },
    ],
    views: [
      {
        namespace: 'westpack',
        afterEnter(data) {
          animateHero(data.next.container);
        },
      },
    ],
  });
}

domReady(() => {
  initBarba();
});
