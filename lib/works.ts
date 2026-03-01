// lib/works.ts

export type WorkCategory =
    | "tum"
    | "konser"
    | "toplanti"
    | "lansman"
    | "fuar";

export type Work = {
    slug: string;          // detay sayfası için: /works/[slug]
    title: string;         // kartın üstünde yazan
    subtitle?: string;     // küçük açıklama (opsiyonel)
    category: WorkCategory;
    cover: string;         // public içinden path: /images/works/....
};

export const workCategories: { key: WorkCategory; label: string }[] = [
    { key: "tum", label: "Tüm işler" },
    { key: "konser", label: "Konser & Festival & Tiyatro" },
    { key: "toplanti", label: "Toplantı & Konferans" },
    { key: "lansman", label: "Lansman & Gala & Sergi" },
    { key: "fuar", label: "Fuar & Stand Uygulamaları" },
];

// Şimdilik cover + kategori yeter.
// Detay sayfasına geçince buraya: year, location, gallery[] vs ekleriz.
export const works: Work[] = [
    {
        slug: "turk-telekom",
        title: "TÜRK TELEKOM",
        category: "lansman",
        cover: "/images/works/turk-telekom.jpg",
    },
    {
        slug: "kultur-bakanligi",
        title: "KÜLTÜR BAKANLIĞI",
        category: "lansman",
        cover: "/images/works/kultur-bakanligi.jpg",
    },
    {
        slug: "black-eyed-peas",
        title: "BLACK EYED PEAS",
        category: "konser",
        cover: "/images/works/black-eyed-peas.jpg",
    },
    {
        slug: "binghatti",
        title: "BINGHATTI",
        category: "lansman",
        cover: "/images/works/binghatti.jpg",
    },
    {
        slug: "cxo-media",
        title: "CXO MEDIA",
        category: "toplanti",
        cover: "/images/works/cxo-media.jpg",
    },
    {
        slug: "trt-avaz",
        title: "TRT AVAZ",
        category: "toplanti",
        cover: "/images/works/trt-avaz.jpg",
    },
    {
        slug: "loreal",
        title: "L'OREAL",
        category: "lansman",
        cover: "/images/works/loreal.jpg",
    },
    {
        slug: "umudun-izleri",
        title: "UMUDUN İZLERİ",
        category: "fuar",
        cover: "/images/works/umudun-izleri.jpg",
    },
];