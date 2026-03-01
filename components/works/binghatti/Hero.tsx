"use client";

import WorkHero from "@/components/sections/work-detail/WorkHero";

type Props = {
  backgroundImage: string;
  videoSrc: string;
};

export default function Hero({ backgroundImage, videoSrc }: Props) {
  return (
      <WorkHero
          backgroundImage={backgroundImage}
          videoSrc={videoSrc}
          // Binghatti için alt bar siyah
          barColor="#000000"
          barHeight={120}
          // kadraj
          imageObjectPosition="20% 20%"
          // logo / menu konumu
          logoLeft={180}
          logoTop={60}
          menuLeft={630}
          menuTop={85}
      />
  );
}