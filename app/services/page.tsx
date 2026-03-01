import HeaderBar from "@/components/layout/HeaderBar";
import ServiceBlock from "@/components/sections/services/ServiceBlock";
import Footer from "@/components/layout/Footer";

export default function ServicesPage() {
    return (
        <main className="bg-white">
            {/* ÜST HEADER (1440x391 mor bar) */}
            <HeaderBar active="services" />

            {/* SAYFA BAŞLIĞI */}
            <section className="w-full bg-white">
                <div className="mx-auto max-w-[1440px] px-[123px] py-[90px]">
                    <div className="flex items-start gap-[18px]">
                        <div className="mt-[10px] h-[88px] w-[2px] bg-[#C41027]" />
                        <h1 className="font-[Rubik] text-[48px] font-semibold leading-[1] text-[#C41027]">
                            HİZMETLERİMİZ
                        </h1>
                    </div>
                </div>
            </section>

            <ServiceBlock
                title="Görüntü Sistemleri"
                description="Etkinlikler için her mekana ve konsepte özel görüntü sistemleri kuruyoruz. Led ekranlar ile farklı projelerde yenilikçi ve özel kurulumlar geliştiriyor, projenizi bir üst seviyeye çıkarıyoruz."
                image="/images/services/goruntu-sistemleri.jpg"
                bullets={[
                    "İç ve dış mekan LED ekran sistemleri",
                    "Özel ölçü ve formda LED tasarımlar",
                    "Transparan led, floor led, curve led",
                    "Watchout ile senkron içerik altyapısı sağlama",
                    "Canlı reji hizmetimiz ile proje esnasında da kusursuz yönetim",
                ]}
            />

            <ServiceBlock
                title="Ses ve Işık Sistemleri"
                description="Ses sistemlerinde etkinliğin yapıldığı mekânın akustik özelliklerini önceden analiz ederek, her noktada dengeli ve net duyum sağlayan profesyonel ses sistemleri kuruyoruz. Işığı yalnızca bir teknik unsur olarak değil, etkinliğin atmosferini ve duygusunu belirleyen temel bir tasarım aracı olarak ele alıyoruz."
                image="/images/services/ses-isik.jpg"
                bullets={[
                    "Hoparlör yerleşimi",
                    "Ses dağılımı",
                    "Sahne ve izleyici alanı dengesi",
                    "Işıkta sahne vurguları",
                    "Renk senaryoları",
                    "Performans ve içerikle senkron geçişler",
                ]}
            />

            <ServiceBlock
                title="3D Sahne Tasarımı"
                description="Etkinlik ve prodüksiyon süreçlerinde etkinliğin tüm teknik ve görsel unsurlarını taşıyan sahne yapılarıyla, markaya özel güçlü bir tasarım planı oluşturuyoruz. Projenin tüm dinamiklerini önceden görmenizi sağlayan profesyonel 3D sahne tasarımları hizmeti veriyoruz."
                image="/images/services/sahne-3d.jpg"
                bullets={[
                    "Sahne platformları ve özel ölçü uygulamalar",
                    "Truss sistemleri (alüminyum / modüler)",
                    "Arka fonlar, sahne dekorları, podyum",
                    "LED ve ışıkla entegre sahne çözümleri",
                ]}
            />

            <ServiceBlock
                title="Etkinlik ve Reji Yönetimi"
                description="Etkinlik esnasında sahnedeki tüm teknik ve görsel akışın tek merkezden kontrol edilmesini sağlayan profesyonel etkinlik yönetimi ve reji hizmeti sunuyoruz. İçerik akışı, sahne geçişleri, görüntü-ses-ışık senkronizasyonu ve zamanlama; etkinlik başlamadan önce detaylı planlanır ve canlı etkinlik sırasında kusursuz şekilde yönetilir."
                image="/images/services/reji.jpg"
                bullets={[
                    "Watchout Media Server",
                    "Etkinlik akışı ve zaman planlaması",
                    "Reji planı ve teknik ekip koordinasyonu",
                    "LED, projeksiyon ve çoklu görüntü yüzeylerinin merkezi kontrolü",
                    "Canlı etkinlik sırasında reji takibi ve teknik destek",
                ]}
            />

            <Footer />
        </main>
    );
}