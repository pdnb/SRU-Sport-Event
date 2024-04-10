{{-- MENU --}}
<x-menu activate-by-route>

    {{-- User --}}
    @if($user = auth()->user())
        <x-menu-separator />

        <x-list-item :item="$user" value="name" sub-value="university.name" avatar="auth0.picture" no-separator no-hover class="-mx-2 !-my-2 rounded">
            <x-slot:actions>
                <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="ออกจากระบบ" onCLick="logoutModal.showModal(); return false;" />
            </x-slot:actions>
        </x-list-item>

        <x-menu-separator />

        <x-menu-item title="หน้าหลัก" icon="o-home" link="/" />
        <x-menu-item title="สมัครเข้าร่วมแข่งขัน" icon="o-user-plus" link="/register" />
    @else
        <x-menu-separator />
        <x-button no-wire-navigate class="btn-primary" link="/auth/login" icon="o-arrow-right-end-on-rectangle">เข้าสู่ระบบด้วย Google</x-button>
        <x-menu-separator />

        <x-menu-item title="หน้าหลัก" icon="o-home" link="/" />
    @endif

    <x-menu-sub title="โปรแกรมการแข่งขัน" icon="o-calendar-days">
        <x-menu-item title="แชร์บอล" icon="o-clock" link="/schedule/1S59fYgnmbV4DL1H2QxTpPmITCqMtMnLX" />
        <x-menu-item title="ตะกร้อ" icon="o-clock" link="/schedule/1WWp_elbtZYUB4VkegDUkwgz6AKYSjbyc" />
        <x-menu-item title="บาสเกตบอล" icon="o-clock" link="/schedule/1I_MTdtRCcxQQZ79rJ7rISof2jreWMWeK" />
        <x-menu-item title="เปตอง" icon="o-clock" link="/schedule/1C1M0CUhd9YJhlrcqcab03u-gtU0Q4pn7" />
        <x-menu-item title="ฟุตซอล" icon="o-clock" link="/schedule/1T_yIGOW4KzM4qKxNdpstg2xd_jaw2lrn" />
        <x-menu-item title="ฟุตบอล" icon="o-clock" link="/schedule/1euagOosUhJuLnurzHX4hSUyE1iN6z9TQ" />
        <x-menu-item title="วอลเลย์บอล" icon="o-clock" link="/schedule/1gNiQroHDqhTa31KXJY4YybPPmjRcJyxY" />
    </x-menu-sub>
    <x-menu-item title="ผลการแข่งขัน" icon="o-trophy" link="/score" />
</x-menu>
