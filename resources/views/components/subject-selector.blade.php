@props(['subjects' => [], 'selected' => []])

<div>
    <label for="subjects" class="block text-sm font-medium text-gray-700 mb-2">
        Assign Subjects *
    </label>
    <div class="relative">
        <select name="subjects[]" id="subjects" multiple
            class="w-full px-4 py-3 rounded-xl border border-gray-300 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('subjects') border-red-500 @enderror"
            style="height: 150px;">
            @forelse($subjects as $subject)
                <option value="{{ $subject->id }}" {{ in_array($subject->id, old('subjects', $selected)) ? 'selected' : '' }}>
                    {{ $subject->name }} ({{ $subject->code }})
                </option>
            @empty
                <option value="" disabled>No subjects available</option>
            @endforelse
        </select>
    </div>
    <p class="mt-2 text-xs text-gray-500">Hold Ctrl (Windows) or Cmd (Mac) to select multiple subjects</p>
    @error('subjects')
        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
