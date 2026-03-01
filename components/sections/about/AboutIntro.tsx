import Image from "next/image";

export default function AboutIntro() {
    return (
        <section className="w-full bg-white">
            <div className="mx-auto max-w-[1440px] px-[123px] py-[90px]">
                {/* ÜST BÖLÜM - "Biz Kimiz?" */}
                <div>
                    <div className="flex items-start gap-[18px]">
                        <div className="mt-[10px] h-[165px] w-[2px] bg-[#C41027]" />
                        <div>
                            <h1 className="font-[Rubik] text-[48px] font-semibold leading-[1] text-[#C41027]">
                                Biz <br /> Kimiz?
                            </h1>

                            <p className="mt-[24px] max-w-[520px] font-[Rubik] text-[20px] font-light leading-[1.5] text-[#442D84]">
                                Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde; ileri teknoloji
                                ile yaratıcı prodüksiyon çözümleri sunan profesyonel bir ekibiz.
                            </p>
                        </div>
                    </div>
                </div>

                {/* İLETİŞİM BLOK - ORTALANMIŞ VE ALTINDA */}
                <div className="mt-[60px] flex justify-center">
                    <div className="text-center font-[Rubik] text-[14px] leading-[1.7] text-[#442D84]">
                        <p className="font-semibold text-[16px] mb-[12px]">İletişim Bilgileri</p>
                        <p>
                            Oruçreis Mah. Tekstilkent Cad. <br />
                            Tekstilkent GD3 Blok No:10AG, İç Kapı <br />
                            No:Z12, 34235, Esenler/İstanbul
                        </p>

                        <div className="mt-[18px] space-y-[10px]">
                            <a className="block underline hover:text-[#C41027] transition" href="mailto:info@albusproduction.com">
                                info@albusproduction.com
                            </a>
                            <a className="block underline hover:text-[#C41027] transition" href="https://instagram.com" target="_blank" rel="noreferrer">
                                Instagram
                            </a>
                        </div>
                    </div>
                </div>

                {/* GÖRSEL */}
                <div className="mt-[80px] flex justify-center">
                    <div className="relative h-[332px] w-[780px] overflow-hidden rounded-lg">
                        <Image
                            src="/images/services/reji.jpg"
                            alt="Albus"
                            fill
                            className="object-cover"
                            priority={false}
                        />
                    </div>
                </div>
            </div>
        </section>
    );
}