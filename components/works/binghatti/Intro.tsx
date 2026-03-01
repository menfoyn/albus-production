"use client";

import WorkIntro from "@/components/sections/work-detail/WorkIntro";

type Props = {
    title: string;
    description: string;
    rightImage: string;
    leftVideo: string;
    dateLabel: string;
    quoteText: string;
};

export default function Intro({
                                  title,
                                  description,
                                  rightImage,
                                  leftVideo,
                                  dateLabel,
                                  quoteText,
                              }: Props) {
    return (
        <WorkIntro
            title={title}
            description={description}
            rightImage={rightImage}
            leftVideo={leftVideo}
            dateLabel={dateLabel}
            quoteText={quoteText}
        />
    );
}