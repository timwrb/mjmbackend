<?php

namespace App\Livewire;

use AllowDynamicProperties;
use App\Models\Company;
use App\Models\jobpost;
use App\Models\PaymentPlans;
use Filament\Facades\Filament;
use Livewire\Component;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\Stripe;

#[AllowDynamicProperties] class CheckoutComponent extends Component
{
    public $jobPosts;
    public $tenantSlug;

    public $showModal = false;

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public $paymentPlans;


    public function mount(Company $tenant)
    {
        $tenant = Filament::getTenant();
        $this->jobPosts = Jobpost::where('company_id', $tenant->id)
            ->where('payed', false)
            ->get();
        $this->tenantSlug = $tenant->name;

        $this->paymentPlans = PaymentPlans::all();
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.checkout-component', [
            'tenantSlug' => $this->tenantSlug,
        ]);
    }


    // STRIPE

    public $selectedJobPost;
    public $selectedPaymentPlan;

    public function selectJobPost($jobPostId)
    {
        $this->selectedJobPost = JobPost::find($jobPostId);
        $this->resetSelectedPaymentPlan(); // Zurücksetzen des ausgewählten Zahlungsplans
    }

    public function selectPaymentPlan($paymentPlanId)
    {
        $this->selectedPaymentPlan = PaymentPlans::find($paymentPlanId);
    }
    public function resetSelectedPaymentPlan()
    {
        $this->selectedPaymentPlan = null;
    }


}
