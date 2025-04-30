document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.carousel-content');
    const cards = document.querySelectorAll('.tool-card');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    
    let currentIndex = 0;
    const cardsPerPage = 2;
    const totalPages = Math.ceil(cards.length / cardsPerPage);
    
    function updateCarousel() {
        // 计算偏移量：每次移动两个卡片的宽度
        const offset = currentIndex * (-100);
        carousel.style.transform = `translateX(${offset}%)`;
        
        // 更新圆点状态
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentIndex);
        });
        
        // // 更新按钮状态
        // prevBtn.style.display = currentIndex === 0 ? 'none' : 'block';
        // nextBtn.style.display = 
        //     currentIndex === totalPages - 1 ? 'none' : 'block';
    }
    
    // 初始化显示
    updateCarousel();
    
    // 绑定事件
    prevBtn.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarousel();
        }
    });
    
    nextBtn.addEventListener('click', () => {
        if (currentIndex < totalPages - 1) {
            currentIndex++;
            updateCarousel();
        }
    });
    
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentIndex = index;
            updateCarousel();
        });
    });
});