"use client";

import Image from "next/image";

type Props = {
  title: string; // "Türk\nTelekom"
  description: string;
  rightImage: string; // /images/works/turk-telekom/2.jpg
  leftVideo: string; // /videos/turk-telekom.mp4 (ya da intro)
  dateLabel: string; // "Ocak 2025"
  quoteText: string;
};

export default function WorkIntro({
                                    title,
                                    description,
                                    rightImage,
                                    leftVideo,
                                    dateLabel,
                                    quoteText,
                                  }: Props) {
  return (
      <section className="w-full bg-white">
        <div className="mx-auto max-w-[1440px] px-[83px] py-[90px]">
          {/* GRID */}
          <div className="grid grid-cols-[452px_1fr] gap-x-[165px]">
            {/* LEFT COLUMN */}
            <div>
              {/* Title block */}
              <div className="flex items-start gap-[18px]">
                <div className="mt-[8px] h-[88px] w-[2px] bg-[#C41027]" />
                <div>
                  <h1 className="font-[Rubik] text-[48px] font-semibold leading-[1] text-[#C41027]">
                    {title.split("\n").map((l, idx) => (
                        <span key={idx} className="block">
                      {l}
                    </span>
                    ))}
                  </h1>

                  <p className="mt-[22px] max-w-[300px] font-[Rubik] text-[15px] font-light leading-[1.55] text-[#442D84]">
                    {description}
                  </p>
                </div>
              </div>

              {/* Left video (Figma: 452x803) */}
              <div className="mt-[58px]">
                <div className="relative h-[803px] w-[452px] overflow-hidden bg-black">
                  <video
                      src={leftVideo}
                      className="h-full w-full object-cover"
                      autoPlay
                      muted
                      loop
                      playsInline
                  />
                </div>
              </div>
            </div>

            {/* RIGHT COLUMN */}
            <div className="relative ml-auto w-[664px]">
              {/* Right image (Figma: 664x718) */}
              <div className="relative h-[718px] w-[664px] overflow-hidden bg-black">
                <Image src={rightImage} alt="Work Visual" fill className="object-cover" />
              </div>

              {/* Quote block – starts exactly under the image */}
              <div className="relative mt-[68px] -ml-[80px]">
                <div className="grid grid-cols-[72px_14px_2px_24px_370px] items-center">
                  {/* Date */}
                  <div className="flex h-[165px] w-[72px] items-center justify-start font-[Rubik] text-[14px] font-light leading-[1.19] tracking-[0.04em] text-[#C41027]">
                    {dateLabel}
                  </div>

                  {/* gap */}
                  <div />

                  {/* Vertical red line */}
                  <div className="h-[195px] w-[2px] bg-[#C41027]" />

                  {/* gap */}
                  <div />

                  {/* Quote text */}
                  <p className="w-[370px] -mt-[90px] font-[Rubik] text-[20px] font-light leading-[1.19] tracking-[0.04em] text-[#442D84]">
                    {quoteText}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  );
}