"use client";

import Image from "next/image";

type Member = {
    role: string;
    name: string;
    image: string;
};

const members: Member[] = [
    {
        role: "Creative & Marketing Director",
        name: "İsim Soyisim",
        image: "/images/about/team-1.jpg",
    },
    {
        role: "Founder",
        name: "İsim Soyisim",
        image: "/images/about/team-2.jpg",
    },
];

export default function AboutMissionVision() {
    return (
        <section
            className="w-full bg-[#120522] overflow-hidden"
            // Figma: 1440 x 956 (senin screenshot)
            style={{ minHeight: "956px" }}
        >
            <div className="mx-auto max-w-[1440px] px-[123px] py-[110px] text-white">
                {/* 2 kolon: Sol (Misyon/Vizyon) + Sağ (Ekibimiz) */}
                <div className="grid grid-cols-[1fr_1fr] gap-[80px] items-start">
                    {/* LEFT */}
                    <div>
                        {/* MISYON */}
                        <div>
                            <h2 className="font-[Rubik] text-[28px] font-semibold tracking-[0.02em]">
                                MİSYONUMUZ
                            </h2>
                            <div className="mt-[10px] h-[2px] w-[140px] bg-white/70" />

                            <h3 className="mt-[28px] font-[Rubik] text-[16px] font-normal text-white/90">
                                Albus Production Olarak Sahneninize Hayat Veriyoruz
                            </h3>

                            {/* Figma width: 521, height: 203 */}
                            <p className="mt-[14px] w-[521px] font-[Rubik] text-[16px] font-light leading-[1.19] text-white/70">
                                Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde yaratıcı
                                fikirleri ileri teknolojiyle buluşturuyor; projenizi eksiksiz ve
                                sorunsuz şekilde hayata geçiriyoruz. Her ayrıntıyı sizin
                                yerinize biz düşünürken, siz sadece izleyicilerinize unutulmaz
                                bir deneyim sunmanın keyfini yaşayın.
                            </p>
                        </div>

                        {/* VIZYON */}
                        <div className="mt-[60px]">
                            <h2 className="font-[Rubik] text-[28px] font-semibold tracking-[0.02em]">
                                VİZYONUMUZ
                            </h2>
                            <div className="mt-[10px] h-[2px] w-[140px] bg-white/70" />

                            {/* Figma width: 518, height: 203 */}
                            <p className="mt-[18px] w-[518px] font-[Rubik] text-[16px] font-light leading-[1.19] text-white/70">
                                Yeni teknolojileri ve anlatım biçimlerini cesurca kullanarak,
                                sahneyi bir iletişim alanı olarak yeniden tanımlamak; izleyiciyle
                                duygusal ve estetik bağ kuran deneyimler üretmek istiyoruz.
                            </p>

                            <p className="mt-[18px] w-[518px] font-[Rubik] text-[16px] font-light leading-[1.19] text-white/70">
                                Amacımız yalnızca teknik yeterliliğiyle değil vizyoner bakış
                                açısıyla da tercih edilen, ilham veren, ulusal ve uluslararası
                                projelerde güvenilir bir iş ortağı olmaktır.
                            </p>
                        </div>
                    </div>

                    {/* RIGHT */}
                    <div className="pt-[10px]">
                        {/* Ekibimiz label (sağ tarafta) */}
                        <div className="flex items-center gap-[12px] text-white/70">
                            <span className="text-[20px] leading-none">↙</span>
                            <span className="font-[Rubik] text-[16px]">Ekibimiz</span>
                        </div>

                        {/* Cards */}
                        <div className="mt-[30px] grid grid-cols-2 gap-[32px]">
                            {members.map((m, i) => (
                                <div key={`${m.role}-${i}`} className="w-[177px]">
                                    {/* Figma card image yaklaşık: 177 x 190 */}
                                    <div className="relative h-[190px] w-[177px] overflow-hidden bg-white">
                                        <Image
                                            src={m.image}
                                            alt={m.name}
                                            fill
                                            className="object-cover"
                                            sizes="177px"
                                        />
                                    </div>

                                    <p className="mt-[14px] font-[Rubik] text-[12px] text-white/70">
                                        {m.role}
                                    </p>
                                    <p className="mt-[6px] font-[Rubik] text-[16px] font-semibold text-white">
                                        {m.name}
                                    </p>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}