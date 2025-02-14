module.exports = {
    // ... autres configurations ...
    theme: {
        extend: {
            animation: {
                'gradient': 'gradient 3s ease infinite',
                'fadeIn': 'fadeIn 0.4s ease-out forwards'
            },
            keyframes: {
                gradient: {
                    '0%': { backgroundPosition: '0% 50%' },
                    '50%': { backgroundPosition: '100% 50%' },
                    '100%': { backgroundPosition: '0% 50%' }
                },
                fadeIn: {
                    'from': { 
                        opacity: '0',
                        transform: 'translateY(-10px)'
                    },
                    'to': { 
                        opacity: '1',
                        transform: 'translateY(0)'
                    }
                }
            }
        }
    }
} 