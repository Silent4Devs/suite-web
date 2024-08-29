<?php

namespace App\Observers;

use App\Events\CatalogueCertificatesEvent;
use App\Models\TBCatalogueTrainingModel;

class CertificatesObserver
{
    // public function created(TBCatalogueTrainingModel $certificate): void
    // {
    //     event(new CatalogueCertificatesEvent($certificate, 'create', 'catalogue_training', 'Tipo de certificación','LD'));
    //     // $this->forgetCache();
    // }

    public function aprobado(TBCatalogueTrainingModel $certificate): void
    {
        // event(new EntendimientoOrganizacionEvent($entendimiento, 'aprobado', 'entendimiento_organizacions', 'Foda'));
        // $this->forgetCache();
    }

    public function deleted(TBCatalogueTrainingModel $certificate): void
    {
        // event(new EntendimientoOrganizacionEvent($entendimiento, 'delete', 'entendimiento_organizacions', 'Entendimiento'));
        // $this->forgetCache();
    }
}
