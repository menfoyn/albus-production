"use client";

import Image from "next/image";

type Props = {
    title: string;
    description: string;
    bullets: string[];

    /**
     * Eğer istersen blok içinde resim basmak için kullanılır.
     * Ama sen Services sayfasında ServiceImage kullandığın için genelde boş bırakacağız.
     */
    image?: string; // optional
};

export default function ServiceBlock({ title, description, bullets, image }: Props) {
    // 2. görseldeki gibi resimle aynı genişlikte hizalama
    const CONTENT_W = 780;

    return (
        <section className="w-full bg-white">
            <div className="mx-auto max-w-[1440px] px-[123px]">
                {/* Eğer image verilirse, blok içinde resim basar. Verilmezse hiç basmaz. */}
                {image ? (
                    <div className="mx-auto pt-[40px]" style={{ width: `${CONTENT_W}px` }}>
                        <div className="relative h-[332px] w-full overflow-hidden bg-black">
                            <Image src={image} alt={title} fill className="object-cover" />
                        </div>
                    </div>
                ) : null}

                {/* Yazı bloğu: 2. görsel gibi resimle aynı hizada (780px) */}
                <div className="mx-auto pb-[90px] pt-[38px]" style={{ width: `${CONTENT_W}px` }}>
                    {/* Desktop: 2 kolon | Mobile: alt alta */}
                    <div className="grid grid-cols-1 gap-y-[28px] md:grid-cols-2 md:gap-x-[70px]">
                        {/* SOL */}
                        <div>
                            <div className="flex items-start gap-[14px]">
                                {/* Kırmızı çizgi: metin yüksekliğine göre uzar */}
                                <div className="mt-[4px] w-[2px] self-stretch bg-[#C41027]" />

                                <div>
                                    <h3 className="font-[Rubik] text-[16px] font-semibold text-[#C41027]">
                                        {title}
                                    </h3>

                                    <p className="mt-[14px] font-[Rubik] text-[14px] font-light leading-[1.55] text-[#442D84]">
                                        {description}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {/* SAĞ */}
                        <div>
                            <h4 className="font-[Rubik] text-[14px] font-semibold text-[#442D84]">
                                Hizmet Kapsamı:
                            </h4>

                            <ul className="mt-[12px] space-y-[6px] font-[Rubik] text-[14px] font-light leading-[1.55] text-[#442D84]">
                                {bullets.map((b, i) => (
                                    <li key={`${title}-${i}`}>• {b}</li>
                                ))}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}