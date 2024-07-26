<?php

namespace Takshak\Areviews\Actions;

class ReviewAction
{
    public function validate($request)
    {
        $validated = $request->validate([
            'rating'    =>  'required|numeric',
            'name'    =>  'required',
            'mobile'    =>  'nullable',
            'email'    =>  'nullable',
            'title'    =>  'nullable',
            'status'    =>  'nullable|boolean',
            'content'    =>  'required',
            'user_id' => 'nullable',
            'reviewable_type'    =>  'required|string',
            'reviewable_id'    =>  'required|numeric',
        ]);

        if (config('areviews.fields.mobile.display') && config('areviews.fields.mobile.required')) {
            $request->validate([
                'mobile' => 'required'
            ]);
        }
        if (config('areviews.fields.email.display') && config('areviews.fields.email.required')) {
            $request->validate([
                'email' => 'required|email'
            ]);
        }
        if (config('areviews.fields.title.display') && config('areviews.fields.title.required')) {
            $request->validate([
                'title' => 'required'
            ]);
        }

        if(isset($validated['user_id'])){
            $validated['user_id'] = $validated['user_id'] ? $validated['user_id'] : auth()->id();
        }else{
            $validated['user_id'] = auth()->id();
        }

        return $validated;
    }
}
