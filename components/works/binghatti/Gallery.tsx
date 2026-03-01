"use client";

import WorkGallery from "@/components/sections/work-detail/WorkGallery";

type Props = {
    images: string[];
};

export default function Gallery({ images }: Props) {
    return <WorkGallery images={images} />;
}