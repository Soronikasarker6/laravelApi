import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { VisuComponent } from './visu/visu.component';

const routes: Routes = [
{  path:'', component:VisuComponent}

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
