/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{js,ts,jsx,tsx,vue}'],
  theme: {
    extend: {
      colors: {
        primaryColor: '#2F57EF',
        secondaryColor: '#B966E7',
        coralColor: '#E9967A',
        violetColor: '#800080',
        pinkColor: '#DB7093',
        blueColor: '#457B9D',
        blackColor: '#111113',
        borderColor: '#e6e3f1',
        headingColor: '#192335',
        bodyColor: '#6B7385',
        whiteColor: '#FFFFFF',
        whiteOffColor: '#FFFFFFAB',
        bodyestColor: '#273041',
        darkColor: '#27272E',
        darkerColor: '#192335',
        greyColor: 'rgba(207,207,207,0.24)',
        grayColor: '#A1A9AC',
        grayLightColor: '#F6F6F6',
        grayLighterColor: '#EBEBEB',
        primaryOpacityColor: '#2F57EF21',
        secondaryOpacityColor: '#B966E721',
        coralOpacityColor: '#E9967A21',
        violetOpacityColor: '#80008021',
        blackOpacityColor: 'rgba(0, 0, 0, 0.04)',
        pinkOpacityColor: '#DB709321',
        dangerOpacityColor: '#FF000310',
        warningOpacityColor: '#FF8F3C10',
        headingOpacityColor: '#19233550',
        cardColor01: '#FFFCCF',
        cardColor02: '#FFEDFF',
        cardColor03: '#FFE8EB',
        cardColor04: '#E9F6FF',
        successColor: '#3EB75E',
        dangerColor: '#FF0003',
        warningColor: '#FF8F3C',
        infoColor: '#1BA2DB'
      },
      backgroundImage: {
        gradient01: 'linear-gradient(90deg,#8da9fc,#b48dd5)',
        gradient02: 'linear-gradient(270deg,#9e77ff,#4460ff)',
        gradient03: 'linear-gradient(to right,#2F57EF,#B966E7,#B966E7,#2F57EF)'
      },
      backgroundColor: {
        overlayColor: 'rgba(0, 0, 0, .8)'
      },
      borderColor: {
        borderColor: '#e6e3f1'
      }
    }
  },
  plugins: []
}
